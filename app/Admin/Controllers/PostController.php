<?php

namespace App\Admin\Controllers;

use App\Models\Post;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PostController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Post::class, function (Grid $grid) {

            if (request('trashed') == 1) {
                $grid->model()->onlyTrashed();
            }

            $grid->id('ID')->sortable();

            $grid->title()->ucfirst()->limit(30);

            $grid->tags()->pluck('name')->label();

            $states = [
                'on' => ['text' => 'YES'],
                'off' => ['text' => 'NO'],
            ];

            $grid->released()->switch($states);

            $grid->rate()->display(function ($rate) {
                $html = "<i class='fa fa-star' style='color:#ff8913'></i>";

                return join('&nbsp;', array_fill(0, min(5, $rate), $html));
            });

            $grid->column('float_bar')->floatBar();

            $grid->created_at();

            $grid->filter(function ($filter) {

                $filter->between('created_at')->datetime();

                $filter->where(function ($query) {

                    $query->whereHas('tags', function ($query) {
                        $query->where('name', $this->input);
                    });

                }, 'Has tag');
            });

            $grid->tools(function ($tools) {

                $tools->append(new Trashed());

                $tools->batch(function (Grid\Tools\BatchActions $batch) {

                    $batch->add('Restore', new RestorePost());
                    $batch->add('Release', new ReleasePost(1));
                    $batch->add('Unrelease', new ReleasePost(0));
                    $batch->add('Show selected', new ShowSelected());
                });

            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Post::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title');

            // load options by ajax
            $form->select('author_id')->options(function ($id) {
                $user = User::find($id);

                if ($user) {
                    return [$user->id => $user->name];
                }
            })->ajax('/admin/api/users');

            $form->textarea('content');

            $form->number('rate');
            $form->switch('released');

            $form->multipleSelect('tags')->options(Tag::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    /**
     * Load options for select.
     *
     * GET /admin/api/users?q=xxx
     *
     * @param Request $request
     * @return mixed
     */
    public function users(Request $request)
    {
        $q = $request->get('q');

        return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    /**
     * POST /admin/models/posts/release
     *
     * @param Request $request
     * @return void
     */
    public function release(Request $request)
    {
        foreach (Post::find($request->get('ids')) as $post) {
            $post->released = $request->get('action');
            $post->save();
        }
    }
    
    /**
     * POST /admin/models/posts/restore
     *
     * @param Request $request
     * @return void
     */
    public function restore(Request $request)
    {
        return Post::onlyTrashed()->find($request->get('ids'))->each(function ($post) {
            $post->restore();
        });
    }
}
