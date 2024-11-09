<template>
    <tr>
        <td v-for="(column, index) in data">{{ column }}<button v-if="index === 'name'" class="btn btn-light"
            @click="onClick">
            <i :class="is_hidden ? 'bi bi-chevron-down' : 'bi bi-chevron-up'"></i></button></td>
    </tr>
    <tr v-for="row of sub_groups">
        <td style="background-color: black; color: white; border: 2px;" v-for="column in row">{{ column }}</td>
    </tr>
</template>

<script setup lang="ts">
    import { defineProps, ref, Ref, onMounted } from 'vue';
    import { IRowGroupData, IRowSubGroupData } from './TableTypes.types';
    import axios from 'axios';

    const props = defineProps<{
        data: IRowGroupData
    }>();

    let is_hidden: Ref<Boolean> = ref(true);
    let sub_groups: Array<IRowSubGroupData> = [];
    let id = 0;
    onMounted(() => {
        id = props.data.id;
        delete props.data.id;
        for (let sub_group in sub_groups) {
            sub_group['lazer'] = sub_group['welding'] = sub_group['electricity'] = NaN;
        }
    });
    async function onClick() {
        if (is_hidden.value) {
            await axios.get(`./api/v1/group/${id}/subgroups`)
            .then((response) => {
                
                for (let sub_group of response['data']) {                    
                    sub_groups.push({name: sub_group['name'], amount: sub_group['amount'], source: sub_group['source']});
                }
                
            })
        }
        else {
            sub_groups = [];
        }
        is_hidden.value = !is_hidden.value
    }
</script>