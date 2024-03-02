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

    dynamics_contact = dynamics_contact || {
        error: "No se ha encontrado el contacto Dynamics",
    };

    dynamics_opportunity = dynamics_opportunity || {
        error: "No se ha encontrado la oportunidad Dynamics",
    };

    dynamics_lead = dynamics_lead || {
        error: "No se ha encontrado el lead Dynamics",
    };

    const breadcrumbLinks = [
        { text: "Preinscripciones", href: "/enrolments" },
        { text: `${enrolment.contact_email}`, href: "#" },
    ];

    let tab = "enrolment";
    const tabClick = (event) => {
        tab = event.detail.value;
    };

    const routes = [
        { text: "Enrolment", value: "enrolment" },
        {
            text: "Contact",
            value: "contact",
        },
        {
            text: "Opportunity",
            value: "opportunity",
        },
        { text: "Lead", value: "lead" },
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
        {#if dynamics_lead.error}
            <div class="p-4 rounded-lg border">
                {dynamics_lead.error}
            </div>
        {:else}
            <ObjectRender data={dynamics_lead.data} />
        {/if}
    {/if}

    {#if tab === "contact"}
        {#if dynamics_contact.error}
            <div class="p-4 rounded-lg border">
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
            <div class="p-4 rounded-lg border">
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
