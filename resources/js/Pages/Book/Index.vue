<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3';
import {usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import moment from "moment"
const props = defineProps({
    books: {
        type: Object,
        default: () => ({}),
    },
});
const format_date=(value)=>{
         if (value) {
           return moment(String(value)).format('YYYY-MM-DD')
          }
};
const form = useForm([]);


function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('book.destroy', id));
    }
}
</script>

<template>
    <Head title="books" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Books</h2>
        </template>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <Link  :href="route('book.create')" class="btn btn-outline-success btn-lg float-right">Add new Book</Link >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div
                                v-if="$page.props.flash?.message"
                                class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                                role="alert"
                            >
                                <span class="font-medium">
                                    {{ $page.props.flash?.message }}
                                </span>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Isbn</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Published</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="books.data.length > 0">
                                    <tr v-for="(book, index) in books.data" :key="book.id">
                                        <th scope="row">{{ index+1 }}</th>
                                        <td>{{ book.title }}</td>
                                        <td>{{ book.description }}</td>
                                        <td>{{ book.author }}</td>
                                        <td>{{ book.isbn }}</td>
                                        <td>{{ book.genre }}</td>
                                        <td>{{ book.publisher }}</td>
                                        <td>{{ format_date(book.published) }}</td>
                                        <td><Link
                                                :href="
                                                    route(
                                                        'book.edit',
                                                        book.id
                                                    )
                                                "
                                               class="btn btn-outline-primary" >Edit</Link
                                            >
                                            <button
                                                type="button"
                                                @click="destroy(book.id)"
                                               class="btn btn-outline-danger" >Delete</button
                                            >
                                        </td>
                                    </tr>

                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="9" align="center">No books Found.<Link
                                                :href="
                                                    route(
                                                        'book.import'
                                                    )
                                                "
                                               class="btn btn-outline-primary" >Import</Link
                                            ></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div className="my-4 d-flex justify-content-center">
                                <ul className="pagination">
                                    <li v-for="(link, index) in books.links" :key="index"
                                        :class="`page-item ${link.active ? 'active' : ''}`">
                                        <Link v-if="link.url !== null" :href="link.url" className="page-link"><span
                                            v-html="link.label"></span>
                                        </Link>
                                        <div v-else className="page-link" v-html="link.label">
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
