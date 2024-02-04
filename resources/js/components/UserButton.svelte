<script>
    import { inertia } from "@inertiajs/svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import IconBadge from "@/components/ui/IconBadge.svelte";
    import Fa from "svelte-fa";
    import {
        faUserAstronaut,
        faUserNinja,
    } from "@fortawesome/free-solid-svg-icons";

    export let user;

    let showOptions = false;

    let menuApply = "bg-neutral-100 dark:bg-neutral-800";
    let optionApply = "hover:bg-neutral-200 dark:hover:bg-neutral-700 ";

    function openMenu() {
        showOptions = true;
    }

    function closeMenu() {
        showOptions = false;
    }
</script>

{#if user}
    <nav on:mouseenter={openMenu} on:mouseleave={closeMenu}>
        <button class={$$props.class}>
            {#if $colorScheme === "dark"}
                <IconBadge icon={faUserNinja} class="dark:bg-transparent" />
            {:else}
                <IconBadge icon={faUserAstronaut} class="bg-transparent" />
            {/if}
        </button>
        <div class=" {showOptions ? 'block' : 'hidden'}">
            <menu class="menu {menuApply}">
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
        </div>
    </nav>
{/if}

<style>
    nav {
        @apply h-14 px-4 flex flex-col justify-center items-center relative;
    }
    .menu {
        @apply shadow
        absolute -translate-x-[85%] top-full w-44
        flex flex-col;
    }
    .option {
        @apply py-2 px-3;
    }
</style>
