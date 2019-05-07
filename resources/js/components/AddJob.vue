<template>
    <div class="container col-sm-6">
        <form>
            <div class="form-group row">
                <label for="jobTitle" class="col-sm-4 col-form-label">Job Title</label>
                <div class="col-sm-8">
                    <input type="text" id="jobTitle" class="col-sm-12">
                </div>
            </div>
            <div class="form-group row">
                <label for="jobDescription" class="col-sm-4 col-form-label">Job Description</label>
                <div class="col-sm-8">
                    <textarea id="jobDescription" class="col-sm-12"></textarea>
                </div>
            </div>
            <div class="text-right">
                <input type="button" name="btn-save-job" class="btn btn-primary col-sm-4" value="SAVE" @click="saveJob">
            </div>
        </form>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        mounted() {
            this.getJobs()
        },
        data() {
            return {

            }
        },
        methods : {
            saveJob() {
                alert('test');
                /*axios.post('api/savejob')
                .then(response => {
                    console.log(response.data)
                })
                .catch(err => {
                    console.log(err)
                })*/
            },
            getJobs() {
                alert('get jobs')
            }
        }
    }
</script>
