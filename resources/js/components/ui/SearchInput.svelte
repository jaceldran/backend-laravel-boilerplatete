<script>
    import { router } from "@inertiajs/svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
    export let q = "";
    export let url;

    const submit = (event) => {
        dispatch("search", { q });
    };

    let timer;
    const debounce = (event) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            if (q.length === 0) {
                // dispatch("reset");
                reset();
            }

            if (q.length >= 3) {
                // dispatch("search", { query });
                search();
            }
        }, 0);
    };

    const search = (event) => {
        router.get(url, { q });
    };

    const reset = () => {
        router.get(url);
    };
</script>

<form
    class="flex brand-light hover:brand-normal dark:brand-dark rounded-full"
    on:submit|preventDefault={submit}
>
    <input
        type="search"
        class="h-10 outline-none px-4 bg-transparent"
        bind:value={q}
        on:input={debounce}
    />
    <button type="submit" class="px-3 h-10">
        <Icon
            icon={faMagnifyingGlass}
            class="text-neon-light-darker dark:text-neon-light-medium"
        />
    </button>
</form>
