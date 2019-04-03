@extends ('master-dashboard')

@section ('title', 'User')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
								</li>
								<li><span>User</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Tabel User</h2>
                </header>
                <div class="panel-body">
                    Content.
                </div>
            </section>
        </div>
    </div>
</section>

@endsection