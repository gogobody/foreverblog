<?php

namespace App\Admin\Extensions;

use App\Blog;
use Encore\Admin\Grid\Exporters\ExcelExporter;
use Maatwebsite\Excel\Concerns\WithMapping;

class BlogsExporter extends ExcelExporter implements WithMapping
{
    protected $fileName = '博客列表.xlsx';

    protected $headings = [
        'ID', '博客名称', '邮箱', '地址', 'Slug', '寄语', '阅读量', '状态', '是否已邮件通知', '提交时间'
    ];

    public function map($blog) : array
    {
        return [
            $blog->id,
            $blog->name,
            $blog->email,
            $blog->link,
            $blog->slug,
            $blog->message,
            $blog->views,
            Blog::STATUS[$blog->status],
            $blog->is_notify ? '是' : '否',
            $blog->created_at ? $blog->created_at->format('Y-m-d H:i:s') : '-',
        ];
    }
}