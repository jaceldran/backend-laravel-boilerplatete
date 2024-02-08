<script>
    import { router } from "@inertiajs/svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
    export let query = "";
    export let url;

    const submit = (event) => {
        dispatch("search", { query });
    };

    let timer;
    const debounce = (event) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            if (query.length === 0) {
                // dispatch("reset");
                reset();
            }

            if (query.length >= 3) {
                // dispatch("search", { query });
                search();
            }
        }, 0);
    };

    const search = (event) => {
        router.get(url, { q: query });
    };

    const reset = () => {
        router.get(url);
    };
</script>

<form
    class="flex bg-neon-light-lighter dark:bg-neon-dark-darker dark:text-green-300 rounded-full"
    on:submit|preventDefault={submit}
>
    <input
        type="search"
        name="query"
        class="h-8 outline-none px-4 bg-transparent"
        bind:value={query}
        on:input={debounce}
    />
    <button type="submit" class="px-3 h-8">
        <Icon
            icon={faMagnifyingGlass}
            class="text-neon-light-darker dark:text-neon-light-medium"
        />
    </button>
</form>
