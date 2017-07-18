<?php

namespace App\Admin\Controllers;

use App\Models\UserMessage, App\Models\Category, App\Models\Region;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserMessageController extends Controller
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

            $content->header('用户需求列表');
            $content->description('包括用户留言,用户需求(潜在买方客户)');

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

            $content->header('用户留言');
            $content->description('All messages');

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

            $content->header('用户留言');
            $content->description('All messages');

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
        return Admin::grid(UserMessage::class, function (Grid $grid) {
            $categories = Category::lists('name', 'id');
            $regions = Region::lists('name', 'id');

            $grid->name();
            $grid->phone();
            $grid->qq('QQ');
            $grid->email();
            $grid->category()->display(function() use ($categories) {
                return $categories[$this->category];
            });
            $grid->region()->display(function() use ($regions) {
                return $regions[1];
            });

            $grid->message();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(UserMessage::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('category', '牌照分类')->options(Category::lists('name', 'id'))->rules('required');
            $form->select('region', '牌照地区')->options(Region::lists('name', 'id'));
            $form->currency('price', '牌照价格')->symbol('￥')->rules('required');

            $form->text('name', '用户昵称')->rules('');
            $form->email('email', '用户邮箱')->rules('email');
            $form->mobile('phone', '用户手机');
            $form->text('qq', '用户QQ')->rules('numeric|min:4');
            $form->textarea('message', '用户留言')->row(4);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
