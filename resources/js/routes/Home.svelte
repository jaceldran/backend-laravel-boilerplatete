<script>
    import Main from "@/layouts/App.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import { jsonRender } from "@/utils";

    export let q;

    const breadcrumbLinks = [{ text: "Home", href: "/" }];
    const routes = [{ text: "Theme", href: "#", active: true }];
</script>

<Main {breadcrumbLinks} class="">
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <SearchInput url="/enrolments" {q} />
    </ToolBar>
    <h1 class="text-hero">Home</h1>

    <section class="grid grid-cols-4 gap-4">
        <div class="brand-lighter">brand-lighter</div>
        <div class="brand-light">brand-light</div>
        <div class="brand-normal">brand-normal</div>
        <div class="brand-accent">brand-accent</div>
        <div class="brand-dark">brand-dark</div>
        <div class="brand-darker">brand-darker</div>
        <div class="brand-darkest">brand-darkest</div>
    </section>

    <section class="grid grid-cols-4 gap-4 dark">
        <div class="bg-neon-400">bg-neon-400</div>
        <div class="bg-neon-500">bg-neon-500</div>
        <div class="bg-neon-600">bg-neon-600</div>
        <div class="bg-neon-700">bg-neon-700</div>
        <div class="bg-neon-800">bg-neon-800</div>
        <div class="bg-neon-900">bg-neon-900</div>
        <div class="bg-neon-950">bg-neon-950</div>
    </section>

    <section class="grid grid-cols-4 gap-4 light">
        <div class="bg-neon-50">bg-neon-50</div>
        <div class="bg-neon-100">bg-neon-100</div>
        <div class="bg-neon-150">bg-neon-150</div>
        <div class="bg-neon-200">bg-neon-200</div>
        <div class="bg-neon-250">bg-neon-250</div>
        <div class="bg-neon-300">bg-neon-300</div>
        <div class="bg-neon-350">bg-neon-350</div>
    </section>
</Main>

<style>
    div {
        @apply rounded-full py-4 px-6 shadow-md  border-4 text-center;
    }
    section {
        @apply border-b-4 py-4;
    }
    section.dark {
        @apply text-white;
    }
</style>
