<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";

    export let payment;

    let data = { ...payment, ...payment.data };

    delete data.data;

    const links = [
        { text: "Payments", href: "/payments" },
        { text: `${payment.reference} (${payment.source_type})`, href: "#" },
    ];

    const refresh = () => {
        alert("Sincronizar Dynamics ");
    };
</script>

<Main>
    <Breadcrumb {links} />

    <ObjectRender {data} />
</Main>
