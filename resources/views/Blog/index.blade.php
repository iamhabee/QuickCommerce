@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'blog'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row p-5 align-items-center">
                        <div class="col-8">
                            <h4 class="mb-0">All Blogs</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary">Add Blog</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Blog Image
                                    </th>
                                    <th>
                                        Blog Title
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>
                                                <img class="avatar border-gray" src="<?php echo $blog->blog_image_url ? asset('blogs')."/". $blog->blog_image_url : asset("paper/img/mike.jpg")?>" alt="...">
                                            </td>
                                            <td>
                                                {{ $blog->title}}
                                            </td>
                                            <td>
                                                {{ $blog->description}}
                                            </td>
                                            <td>
                                            <a rel="tooltip" class="btn btn-success btn-link" href="" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection