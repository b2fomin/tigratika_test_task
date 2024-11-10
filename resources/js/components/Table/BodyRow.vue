<template>
    <tr>
        <td style='white-space: nowrap' v-for="(column, index) in data">
            <div class="btn-group-vertical" v-if="index === 'name'">
            <button @click="() => emit('move-cell-down', current)" class="btn btn-small btn-light" :disabled="current === 0"><i class="bi bi-caret-up-square-fill"></i></button>
            <button @click="() => emit('move-cell-up', current)" class="btn btn-small btn-light" :disabled="current === total - 1"><i class="bi bi-caret-down-square-fill"></i></button></div>
            {{ column }}<button v-if="index === 'name'" class="btn btn-light"
            @click="subGroupClick">
            <i :class="is_hidden ? 'bi bi-chevron-down' : 'bi bi-chevron-up'"></i></button>
        </td>
        <td>
            <button class="btn btn-danger" @click="onDelete"><i class="bi bi-trash-fill"></i></button>
        </td>
    </tr>
    <tr v-for="row of sub_groups">
        <td style="background-color: black; color: white; border: 2px; white-space: nowrap" v-for="column in row">{{ column }}</td>
    </tr>
</template>

<script setup lang="ts">
    import { defineProps, ref, Ref, onUpdated, defineEmits, onMounted } from 'vue';
    import { IRowGroupData, IRowSubGroupData } from './TableTypes.types';
    import axios from 'axios';

    const props = defineProps<{
        data: IRowGroupData,
        total: number,
        current: number
    }>();

    const emit = defineEmits<{
        'move-cell-up': [index: number],
        'move-cell-down': [index: number],
        'delete-row': [index: number]
    }>();

    let is_hidden: Ref<Boolean> = ref(true);
    let sub_groups: Array<IRowSubGroupData> = [];
    let id = ref();
    let extract_id = () => {
        if (id.value === undefined) {
            id.value = props.data.id !== undefined ? props.data.id : 0;
            delete props.data.id;
        }
    }
    onUpdated(extract_id);
    onMounted(extract_id);
    async function subGroupClick() {
        if (is_hidden.value) {
            await axios.get(`./api/v1/group/${id.value}/subgroups`)
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

    async function onDelete() {
        axios.delete(`./api/v1/group/${id.value}`)
        .then((response) => {
            if (response['data']['success']) {
                emit('delete-row', props.current);
                id.value+=1
            } else {
                console.log(response['err_msg']);                
            }
        });
    }
</script>