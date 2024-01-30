<script>
    import { inertia } from "@inertiajs/svelte";
    import Fa from "svelte-fa";
    import {
        faCircleCheck,
        faWarning,
        faInfoCircle,
        faClose,
    } from "@fortawesome/free-solid-svg-icons";

    import { page } from "@inertiajs/svelte";
</script>

{#if $page.props.flash.success}
    <div class="message success">
        <div class="flex gap-2 p-4">
            <Fa icon={faCircleCheck} size="lg" />
            <span>{@html $page.props.flash.success}</span>
        </div>
        <a class="close" use:inertia href="/login">
            <Fa icon={faClose} size="lg" />
        </a>
    </div>
{:else if $page.props.flash.info}
    <div class="message info">
        <div class="flex gap-2 p-4">
            <Fa icon={faInfoCircle} size="lg" />
            <span>{@html $page.props.flash.info}</span>
        </div>
        <a class="close" use:inertia href="/login">
            <Fa icon={faClose} size="lg" />
        </a>
    </div>
{:else if $page.props.flash.warning}
    <div class="message warning">
        <div class="flex gap-2 p-4">
            <Fa icon={faWarning} size="lg" />
            <span>{@html $page.props.flash.warning}</span>
        </div>
        <a class="close" use:inertia href="/login">
            <Fa icon={faClose} size="lg" />
        </a>
    </div>
{/if}

<style>
    .message {
        @apply fixed top-2 left-2 right-2 flex justify-between font-semibold;
    }

    .success {
        @apply bg-emerald-300 text-emerald-700;
    }

    .warning {
        @apply bg-amber-300 text-amber-700;
    }
    .info {
        @apply bg-blue-300 text-blue-700;
    }
    a.close {
        @apply p-4 text-neutral-500;
    }
</style>
