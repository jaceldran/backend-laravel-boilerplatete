<script>
    import Main from "@/layouts/App.svelte";
    import { onMount } from "svelte";
    // import { renderJSON } from "@/utils.js";

    const apiUrl = "https://jsonplaceholder.typicode.com";

    const endpoints = {
        posts: "/posts",
        comments: "/comments",
        albums: "/albums",
        photos: "/photos",
        todos: "/todos",
        users: "/users",
    };

    let data;
    let dataReady = false;
    onMount(async () => {
        const endpoint = `${apiUrl}/${endpoints.users}`;

        const response = await fetch(endpoint);

        data = await response.json();

        console.log(data, data.length + " elementos");

        dataReady = true;
    });
</script>

<Main>
    <!-- {typeof data}

    <pre> {renderJSON(data)}</pre> -->

    {#if dataReady}
        <table class="dark:text-stone-50">
            <thead class="bg-stone-100 dark:bg-stone-800">
                <tr>
                    <th>name</th>
                    <th>company</th>
                    <th>email</th>
                    <th>phone</th>
                </tr>
            </thead>
            <tbody class="dark:bg-stone-700">
                {#each data as { name, company, email, phone, website }}
                    <tr>
                        <td>{name}</td>
                        <td>{company.name}</td>
                        <td class="email">{email}</td>
                        <td class="phone">{phone}</td>
                    </tr>
                {/each}
            </tbody>
        </table>
    {:else}
        CARGANDO...
    {/if}
</Main>

<style>
    h1 {
        @apply text-xl font-medium;
    }
    table {
        @apply w-full;
    }
    tr {
        @apply border-b;
    }
    th {
        @apply text-left font-normal uppercase p-3;
    }
    td {
        @apply p-3;
    }
    .email,
    .phone {
        @apply w-0 whitespace-nowrap;
    }
</style>
