<script>
    import { jsonRender, dateFormat, isDate } from "@/utils";
    import TableContent from "@/components/ui/TableContent.svelte";
    import TableHeader from "@/components/ui/TableHeader.svelte";
    import TableBody from "@/components/ui/TableBody.svelte";
    import TableRow from "@/components/ui/TableRow.svelte";
    import TableTh from "@/components/ui/TableTh.svelte";
    import TableTd from "@/components/ui/TableTd.svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import Icon from "@/components/ui/Icon.svelte";
    import { faC, faClose, faRefresh } from "@fortawesome/free-solid-svg-icons";

    export let enrolment_data;
    export let dynamics;

    const dynamics_data = dynamics.data;
    const dynamics_updated_at = dynamics.updated_at;

    let keys = Object.keys(enrolment_data);

    const equals = (key) => {
        let v1 = String(enrolment_data[key]);
        let v2 = String(dynamics_data[key.toLowerCase()]);

        if (v2 == "undefined" && v1 == "000") {
            v1 = v2;
        }

        if (v2 == "undefined" && JSON.stringify(enrolment_data[key]) == "[]") {
            v1 = v2;
        }

        if (isDate(v1) || isDate(v2)) {
            v1 = dateFormat(v1);
            v2 = dateFormat(v2);
        }

        return v1 == v2;
    };
</script>

<TableContent>
    <TableHeader>
        <TableRow class="text-left">
            <TableTh></TableTh>
            <TableTh>Atributo</TableTh>
            <TableTh>Formulario</TableTh>
            <TableTh class="flex items-center">
                <Icon class="px-2" size="md" icon={faRefresh} />
                <span>
                    Dynamics, hace {formatDistanceToNow(dynamics_updated_at, {
                        locale: es,
                    })}</span
                >
            </TableTh>
        </TableRow>
    </TableHeader>
    <TableBody>
        {#each keys as key}
            {#if enrolment_data[key] || dynamics_data[key]}
                <TableRow>
                    <TableTd class="wmin pl-0">
                        {#if !equals(key) || key !== key.toLowerCase()}
                            <Icon icon={faClose} color="text-red-700" />
                        {/if}
                    </TableTd>
                    <TableTd>
                        <span
                            class="font-medium {key === key.toLowerCase()
                                ? ''
                                : 'text-red-700 underline'}"
                        >
                            {key}
                        </span>
                    </TableTd>
                    <TableTd>{JSON.stringify(enrolment_data[key])}</TableTd>
                    <TableTd
                        >{JSON.stringify(
                            dynamics_data[key.toLowerCase()],
                        )}</TableTd
                    >
                </TableRow>
            {/if}
        {/each}
    </TableBody>
</TableContent>
