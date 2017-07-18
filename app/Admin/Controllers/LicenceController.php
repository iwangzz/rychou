<?php

namespace App\Admin\Controllers;

use App\Models\Licence, App\Models\Category, App\Models\Region;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class LicenceController extends Controller
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

            $content->header('牌照列表');
            $content->description('所有牌照，包括审核中的和未审核的，可直接操作');

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

            $content->header('编辑牌照');
            $content->description('修改编辑牌照信息，审核等操作');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('查看牌照');
            $content->description('');

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

            $content->header('创建牌照');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function getPendingAudit()
    {
        return Admin::content(function (Content $content) {

            $content->header('待审核列表');
            $content->description('待审核项目列表，慎重操作');

            $content->body($this->grid(0));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Licence::class, function (Grid $grid) {
            $categories = Category::lists('name', 'id');
            $regions = Region::lists('name', 'id');

            $grid->id('ID')->sortable();
            $grid->category('牌照分类')->display(function() use ($categories) {
                return $categories[$this->category];
            });
            $grid->region('所属地区')->display(function() use ($regions) {
                return $regions[$this->region];
            });
            $grid->email('联系邮箱');
            $grid->phone('联系电话');
            $grid->qq('QQ');
            $grid->price('价格');

            $states = [
                'Pending-Audit'  => ['value' => 0, 'text' => '待审核', 'color' => 'primary'],
                'Runing' => ['value' => 1, 'text' => '审核成功', 'color' => 'default'],
            ];
            $grid->status('审核状态')->switch($states)->sortable();

            $grid->actions(function ($actions) {
                // append一个操作
                $actions->append('<a href="/admin/licences/' . $actions->getKey() . '"><i class="fa fa-eye"></i></a>');
            });

            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('更新时间')->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Licence::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('category', '牌照分类')->options(Category::lists('name', 'id'))->rules('required');
            $form->select('region', '牌照地区')->options(Region::lists('name', 'id'));
            $form->currency('price', '牌照价格')->symbol('￥')->rules('required')->placeholder('万元');
            $form->image('image', '牌照图片')->rules('required');
            $form->text('company', '所属公司');
            $form->text('equity_ratio', '持股比例');
            $form->date('valid_date', '牌照有效日期');
            $form->number('collection', '关注人数');

            $form->text('name', '用户昵称')->rules('');
            $form->email('email', '用户邮箱')->rules('email');
            $form->mobile('phone', '用户手机');
            $form->text('qq', '用户QQ')->rules('numeric|min:4');
            $form->textarea('message', '用户留言')->row(4);

            $states = [
                'on'  => ['value' => 1, 'text' => '审核通过', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '待审核', 'color' => 'danger'],
            ];

            $form->switch('status', '审核状态')->state($states);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
