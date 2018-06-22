<li class="{{ Request::is('projects*') ? 'active' : '' }}">
    <a href="{!! route('admin.projects.index') !!}">
        <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="thumbnails-big" data-size="18"
           data-loop="true"></i>
        Projects
    </a>
</li>

<li {!! (Request::is('admin/projects/import') ? 'class="active"' : '') !!}>
    <a href="{{ URL::to('admin/projects/import') }}">
        <i class="fa fa-angle-double-right"></i>
        Project Import
    </a>
</li>

<li class="{{ Request::is('infrastructures*') ? 'active' : '' }}">
    <a href="{!! route('admin.infrastructures.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="servers" data-size="18"
               data-loop="true"></i>
               Infrastructures
    </a>
</li>
<li class="{{ Request::is('providers*') ? 'active' : '' }}">
    <a href="{!! route('admin.providers.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="shield" data-size="18"
               data-loop="true"></i>
               Providers
    </a>
</li>

<li class="{{ Request::is('images*') ? 'active' : '' }}">
    <a href="{!! route('admin.images.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="image" data-size="18"
               data-loop="true"></i>
               Images
    </a>
</li>

<li class="{{ Request::is('news*') ? 'active' : '' }}">
    <a href="{!! route('admin.news.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="globe" data-size="18"
               data-loop="true"></i>
               News
    </a>
</li>

<li class="{{ Request::is('beneficiaries*') ? 'active' : '' }}">
    <a href="{!! route('admin.beneficiaries.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="users" data-size="18"
               data-loop="true"></i>
               Beneficiaries
    </a>
</li>

<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{!! route('admin.contacts.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="user" data-size="18"
               data-loop="true"></i>
               Contacts
    </a>
</li>

<li class="{{ Request::is('verticals*') ? 'active' : '' }}">
    <a href="{!! route('admin.verticals.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               Verticals
    </a>
</li>
<li class="{{ Request::is('conectivities*') ? 'active' : '' }}">
    <a href="{!! route('admin.conectivities.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="servers" data-size="18"
               data-loop="true"></i>
               Conectivities
    </a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="bank" data-size="18"
               data-loop="true"></i>
               Categories
    </a>
</li>

<li class="{{ Request::is('categoryProjects*') ? 'active' : '' }}">
    <a href="{!! route('admin.categoryProjects.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="desktop" data-size="18"
               data-loop="true"></i>
               CategoryProjects
    </a>
</li>


