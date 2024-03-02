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
    class="search flex rounded-full translate-x-5"
    on:submit|preventDefault={submit}
>
    <input
        type="search"
        class="h-10 outline-none pl-4 pr-14 rounded-full bg-inherit"
        bind:value={q}
        on:input={debounce}
    />
    <Icon icon={faMagnifyingGlass} class="-translate-x-5" />
</form>
