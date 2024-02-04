<script>
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faEnvelope, faKey } from "@fortawesome/free-solid-svg-icons";
    import { router } from "@inertiajs/svelte";

    export let errors;

    const controlColors = "border dark:border-neutral-600";
    const inputColors =
        "bg-neutral-100 dark:text-neutral-300 dark:bg-neutral-600";
    const iconColors =
        "bg-neutral-100 dark:text-neutral-300 dark:bg-neutral-600";
    const buttonColors = "bg-neutral-500 text-white dark:bg-neutral-600";

    const form = {
        email: "",
        password: "",
    };

    const submit = () => {
        router.post(`/login`, form);
    };
</script>

<svelte:head>
    <title>Login</title>
</svelte:head>

<Main context="login">
    <form on:submit|preventDefault={submit}>
        <section>
            <div class="input-control {controlColors}">
                <span class="icon {iconColors}">
                    <Icon icon={faEnvelope} />
                </span>
                <input
                    id="input-email"
                    type="email"
                    name="email"
                    placeholder="Email"
                    class={inputColors}
                    bind:value={form.email}
                />
            </div>
            {#if errors.email}
                <div class="input-error">{errors.email}</div>
            {/if}
        </section>

        <section>
            <div class="input-control {controlColors}">
                <span class="icon {iconColors}">
                    <Icon icon={faKey} />
                </span>
                <input
                    id="input-passworkd"
                    type="password"
                    name="password"
                    class={inputColors}
                    placeholder="Password"
                    bind:value={form.password}
                />
            </div>
            {#if errors.password}
                <div class="input-error">{errors.password}</div>
            {/if}
        </section>

        <section>
            <p class="py-2 flex justify-between items-center">
                <button type="submit" class={buttonColors}> Login </button>
                <a href="/register"> Register </a>
            </p>
        </section>
    </form>
</Main>

<style>
    form {
        @apply h-5/6 flex flex-col gap-4 items-center justify-center font-medium;
    }
    section {
        @apply flex flex-col w-72;
    }
    .input-control {
        @apply shadow-sm flex items-center rounded;
    }
    .input-control > input {
        @apply w-full h-12 outline-none;
    }
    .input-control > .icon {
        @apply h-12 px-3 flex justify-center items-center;
    }
    .input-error {
        @apply text-red-600 text-sm;
    }
    button {
        @apply h-12 px-4 w-28 rounded font-bold text-sm uppercase duration-200;
    }
    button:hover {
        @apply tracking-[4px];
    }
</style>
