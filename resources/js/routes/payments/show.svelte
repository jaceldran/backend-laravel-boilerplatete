<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";

    export let payment;

    let data = { ...payment, ...payment.data };

    delete data.data;

    const breadcrumbLinks = [
        { text: "Pagos", href: "/payments" },
        { text: `${payment.reference} (${payment.source_type})`, href: "#" },
    ];

    const refresh = () => {
        alert("Sincronizar Dynamics ");
    };
</script>

<Main {breadcrumbLinks}>
    <h1 class="text-hero">Payment</h1>
    <ObjectRender {data} />
</Main>
