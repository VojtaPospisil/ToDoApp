<div class="content__left">
    <section class="playlist">
        <a href="{{ route('admin.home') }}">
            <i class="ion-ios-plus-outline"></i>
            Přehled
        </a>
    </section>
    <section class="playlist">
{{--        <router-link :to="{name: 'task.index'}">--}}
{{--            <a>--}}
{{--                <i class="ion-ios-plus-outline"></i>--}}
{{--                Úkoly--}}
{{--            </a>--}}
{{--        </router-link>--}}
        <a href="{{ route('task.index') }}">
            <i class="ion-ios-plus-outline"></i>
            Úkoly
        </a>
    </section>
    <section class="playlist">
        <a href="{{ route('category.index') }}">
            <i class="ion-ios-plus-outline"></i>
            Kategorie
        </a>
    </section>
    <section class="playlist">
        <a href="{{ route('user.index') }}">
            <i class="ion-ios-plus-outline"></i>
            Uživatelé
        </a>
    </section>
</div>
