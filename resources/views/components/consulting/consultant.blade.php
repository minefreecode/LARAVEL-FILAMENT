@props([
    'avatar',
    'name',
    'title',
])

<div
    x-data="{
        book_is_hovered: false,
    }"
    class="flex flex-col items-center rounded-xl bg-merino/50 p-7 text-center"
>
    <!--
    включает flex,
    flex-col -вертикально по оси флекса,
    rounded-xl  - округление элемента,
    p-7 - паддинг,
    text-center - центрирует текст
    -->
    {{--
    aspect-square - соотношение сторон как квадрат,
    w-28 - задает ширину элемента,
     rounded-full - делает полное закругление
     transition - переходы при наведении
     duration-300 - время перехода для transition
     lg:w-36 - для широких экранов применяется только такой стиль
     --}}
    <img
        src="{{ $avatar }}"
        alt="{{ $name }}"
        height="144"
        width="144"
        class="aspect-square w-28 rounded-full transition duration-300 lg:w-36"
        :class="{
                'scale-105': book_is_hovered,
            }"
        loading="lazy"
    />
    {{--
    pt-5  - padding top

      --}}
    <div
        class="pt-5 transition duration-300"
        :class="{
            'translate-x-1': book_is_hovered,
        }"
    >
        {{--
        text-2xl - размер текста. текст в 2 раза сверхбольшой
        font-bold - вес текста
        lg:text-3xl - для больших экранов в 3 раза сверхбольшой
        --}}
        <div class="text-2xl font-bold lg:text-3xl">
            {{ $name }}
        </div>

        {{--
         pt-1 - паддинг верхний
         text-base  - размер текста базовый
         font-medium - шрифт средний
         text-dolphin - цвет #6C6489
         lg:text-lg - для больших экранов шрифт другой
         --}}
        <div class="pt-1 text-base font-medium text-dolphin lg:text-lg">
            {{ $title }}
        </div>

        {{--
         mx-auto - для горизонтального центрирования
         my-4 - вертикальные марджины
         h-px - высота 1 пиксель
         w-full
         max-w-[23rem] - для ограничения ширины
         rounded-full
         bg-dolphin/20
         --}}
        <div
            class="mx-auto my-4 h-px w-full max-w-[23rem] rounded-full bg-dolphin/20"
        ></div>

        {{-- Description --}}
        <div
            class="prose px-3 text-dolphin prose-a:text-burnt-dolphin prose-strong:text-burnt-dolphin"
        >
            {{ $slot }}
        </div>
    </div>
</div>
