<script>
    import Main from "@/layouts/App.svelte";
    import { jsonRender } from "@/utils";
</script>

<Main class="h-screen flex flex-col items-center justify-center">
    [HOME]

    <section class="flex">
        <div class="bg-neon-dark-lightest">bg-neon-dark-lightest</div>
        <div class="bg-neon-dark-lighter">bg-neon-dark-lighter</div>
        <div class="bg-neon-dark-light">bg-neon-dark-light</div>
        <div class="bg-neon-dark-medium">bg-neon-dark-medium</div>
        <div class="bg-neon-dark-dark">bg-neon-dark-dark</div>
        <div class="bg-neon-dark-darker">bg-neon-dark-darker</div>
        <div class="bg-neon-dark-darkest">bg-neon-dark-darkest</div>
    </section>

    <section class="flex">
        <div class="bg-neon-light-lightest">bg-neon-light-lightest</div>
        <div class="bg-neon-light-lighter">bg-neon-light-lighter</div>
        <div class="bg-neon-light-light">bg-neon-light-light</div>
        <div class="bg-neon-light-medium">bg-neon-light-medium</div>
        <div class="bg-neon-light-dark">bg-neon-light-dark</div>
        <div class="bg-neon-light-darker">bg-neon-light-darker</div>
        <div class="bg-neon-light-darkest">bg-neon-light-darkest</div>
    </section>
</Main>

<style>
    div {
        @apply p-8 text-white h-full;
    }
</style>
