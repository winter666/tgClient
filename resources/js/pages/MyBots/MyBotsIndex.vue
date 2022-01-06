<template>
    <div id="my-bots-index">
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
                <th>Field ...</th>
            </thead>
            <tbody>
                <tr v-for="bot in bots" :key="bot.id">
                    <td>{{ bot.id }}</td>
                    <td>{{ bot.name }}</td>
                    <td>{{ bot.status }}</td>
                    <td>{{ bot.field }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "MyBotsIndex",
    data() {
        return {
            bots: [
                {
                    id: 1,
                    name: 'Test',
                    status: "Active",
                    field: 'Foo'
                },
                {
                    id: 2,
                    name: 'Test',
                    status: "Active",
                    field: 'Bar'
                },
                {
                    id: 3,
                    name: 'Test',
                    status: "Active",
                    field: 'Baz'
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
