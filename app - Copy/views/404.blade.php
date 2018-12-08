@extends('layout')

@section('content')
    <div id="contentwrapper">
        <div class="main_content">
            <nav>
                <div id="jCrumbs" class="breadCrumb module">
                    <ul>
                        <li>
                            <a href="{{ url('dashboard/') }}"><i class="icon-home"></i></a>
                        </li>
                        <li>
                            <a href="{{ url('dashboard/') }}">404</a>
                        </li>
                        <li>
                            Not found
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">404</h3>
                    <strong>Data tidak ditemukan</strong>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
@stop