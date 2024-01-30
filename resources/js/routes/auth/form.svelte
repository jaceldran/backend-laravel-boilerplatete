<script>
    import Main from "@/layouts/Login.svelte";

    import Fa from "svelte-fa";
    import { faEnvelope, faKey } from "@fortawesome/free-solid-svg-icons";
    import { router } from "@inertiajs/svelte";

    export let errors;

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

<Main>
    <form on:submit|preventDefault={submit}>
        <section>
            <div class="flex items-center">
                <label for="input-email"> Email </label>
                <div class="icon-container">
                    <Fa icon={faEnvelope} size="lg" class="text-stone-500" />
                </div>
                <input
                    id="input-email"
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="bg-stone-200"
                    bind:value={form.email}
                />
            </div>
            {#if errors.email}
                <div class="text-red-600 text-sm ml-24">{errors.email}</div>
            {/if}

            <div class="flex items-center">
                <label for="input-password"> Password </label>
                <div class="icon-container">
                    <Fa icon={faKey} size="lg" class="text-stone-500" />
                </div>
                <input
                    id="input-password"
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="bg-stone-200"
                    bind:value={form.password}
                />
            </div>
            {#if errors.password}
                <div class="text-red-600 text-sm ml-24">{errors.password}</div>
            {/if}

            <div class="mt-1">
                <button type="submit" class="bg-stone-700 text-stone-100">
                    <span>Login</span>
                </button>
            </div>
        </section>
    </form>
</Main>

<style>
    form {
        @apply h-svh flex flex-col items-center justify-center bg-stone-300 font-medium;
    }
    input {
        @apply w-full h-10 px-3 outline-none;
    }
    .icon-container {
        @apply bg-stone-200 h-10 flex flex-col justify-center pl-3;
    }
    section {
        @apply mx-auto flex flex-col gap-2 w-96;
    }
    label {
        @apply h-6 inline-block w-36 text-stone-400;
    }
    button {
        @apply mt-2 h-10 px-4 self-end rounded bg-stone-700 text-stone-100;
    }
</style>
