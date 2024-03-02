<script>
    import { inertia } from "@inertiajs/svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    // import IconBadge from "@/components/ui/IconBadge.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    // import Fa from "svelte-fa";
    import {
        faUserAstronaut,
        faUserNinja,
    } from "@fortawesome/free-solid-svg-icons";

    export let user;

    let showOptions = false;

    let optionApply = "hover:bg-neutral-200 dark:hover:bg-neutral-700 ";

    function openMenu() {
        showOptions = true;
    }

    function closeMenu() {
        showOptions = false;
    }
</script>

{#if user}
    <nav on:mouseenter={openMenu} on:mouseleave={closeMenu} class="relative">
        <button class={$$props.class}>
            {#if $colorScheme === "dark"}
                <Icon
                    size="lg"
                    icon={faUserNinja}
                    class="dark:bg-transparent {$$props.class}"
                />
            {:else}
                <Icon
                    size="lg"
                    icon={faUserAstronaut}
                    class="bg-transparent {$$props.class}"
                />
            {/if}
        </button>
        <menu
            class="dark:bg-darker"
            style="display:{showOptions ? 'block' : 'none'}"
        >
            <span
                class="pl-2 mt-2 font-semibold text-xs text-violet-500 tracking-tighter uppercase"
                >{user.name}</span
            >
            <a class="option {optionApply}" href="/user">Cuenta</a>
            <a class="option {optionApply}" href="/user">Preferencias</a>
            <hr class="dark:border-black" />
            <hr class="border-white dark:border-neutral-700" />
            <a use:inertia class="option {optionApply}" href="/logout"
                >Cerrar sesión</a
            >
        </menu>
    </nav>
{/if}

<style>
    nav {
        @apply h-14 px-4 flex flex-col justify-center items-center relative;
    }
    menu {
        @apply shadow bg-neutral-50
        absolute -translate-y-0 -translate-x-[40%] top-full w-44
        flex flex-col z-10;
    }
    .option {
        @apply block py-2 px-3;
    }
</style>
