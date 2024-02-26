<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import { jsonRender, dateFormat, isDate } from "@/utils";
    import Comparative from "@/routes/enrolments/Comparative.svelte";
    import Toolbar from "@/components/ui/Toolbar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";

    export let enrolment;
    export let dynamics_lead;
    export let dynamics_contact;
    export let dynamics_opportunity;

    let enrolment_data = { ...enrolment, ...enrolment.data };

    delete enrolment_data.data;

    const breadcrumbLinks = [
        { text: "Enrolments", href: "/enrolments" },
        { text: `${enrolment.contact_email}`, href: "#" },
    ];

    let tab = "enrolment";
    const tabClick = (event) => {
        tab = event.detail.value;
    };

    const routes = [
        { text: "Enrolment", value: "enrolment" },
        {
            text: "Comparar contact",
            value: "contact",
        },
        {
            text: "Comparar opportunity",
            value: "opportunity",
        },
        { text: "Ver lead", value: "lead" },
    ];
</script>

<Main {breadcrumbLinks}>
    <Toolbar class="gap-2">
        <Navigation
            class="horizontal subnav"
            on:click={tabClick}
            buttonValue={tab}
            {routes}
        />
    </Toolbar>

    <!-- <pre>{jsonRender(routes)}</pre> -->

    {#if tab === "enrolment"}
        <ObjectRender data={enrolment_data} />
    {/if}

    {#if tab === "lead"}
        <ObjectRender data={dynamics_lead.data} />
    {/if}

    {#if tab === "contact"}
        {#if dynamics_contact.error}
            <div
                class=" border-red-700 border-2 font-medium text-red-700 p-4 text-xl"
            >
                {dynamics_contact.error}
            </div>
        {:else}
            <Comparative
                enrolment_data={enrolment.data.contact}
                dynamics={dynamics_contact}
            />
        {/if}
    {/if}

    {#if tab === "opportunity"}
        {#if dynamics_opportunity.error}
            <div
                class=" border-red-700 border-2 font-medium text-red-700 p-4 text-xl"
            >
                {dynamics_opportunity.error}
            </div>
        {:else}
            <Comparative
                enrolment_data={enrolment.data.opportunity}
                dynamics={dynamics_opportunity}
            />
        {/if}
    {/if}
</Main>

<style>
    button {
        @apply py-0 px-3 shadow border-neon-100 rounded-full text-sm;
    }
    button.active {
        @apply bg-neon-500 text-white;
    }
</style>
