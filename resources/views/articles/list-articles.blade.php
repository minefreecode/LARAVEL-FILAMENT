<!-- Исполльзует шаблон app для заполнения -->
<x-layouts.app>
    <!--
    Вставляет компонент articles.hero
     Прикрепляет туда переменные $articlesCount, $authorsCount, $starsCount для использования в шаблонах blade
     -->
    <x-articles.hero
        :$articlesCount
        :$authorsCount
        :$starsCount
    />

    <div
        class="mx-auto mt-5 w-full max-w-[82.5rem] border-t border-merino"
    ></div>

    <!--
    Вставляет компонент articles.list
    -->
    <x-articles.list
        :$articles
        :$categories
        :$types
    />
</x-layouts.app>
