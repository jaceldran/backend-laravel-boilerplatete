<script>
    export let height;

    height = height || "h-10";
</script>

<section class="flex items-center {height} my-4 {$$props.class}">
    <slot />
</section>
