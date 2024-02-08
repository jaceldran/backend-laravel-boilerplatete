<script>
    export let height;

    height = height || "py-2";
</script>

<section class="flex {height} {$$props.class}">
    <slot />
</section>
