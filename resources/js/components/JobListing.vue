<template>
    <div>
        <div class="container col-sm-6">
            <h3>Create Job</h3>
            <div class="form-group row">
                <label for="jobTitle" class="col-sm-4 col-form-label">Job Title</label>
                <div class="col-sm-8">
                    <input type="text" id="jobTitle" class="col-sm-12" v-model="jobTitle">
                </div>
                <div :errors="errors" v-if="errors.title" class="text-right col-sm-12">
                    <p class="text-danger" v-for="err in errors.title">*{{ err }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="jobDescription" class="col-sm-4 col-form-label">Job Description</label>
                <div class="col-sm-8">
                    <textarea id="jobDescription" class="col-sm-12" v-model="jobDescription"></textarea>
                </div>
                <div :errors="errors" v-if="errors.description" class="text-right col-sm-12">
                    <p class="text-danger" v-for="err in errors.description">*{{ err }}</p>
                </div>
            </div>
            <div class="text-right">
                <a href="javascript:void(0);" @click="saveJob" class="btn btn-primary col-sm-4">SAVE</a>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">All Jobs</div>
                        <div class="card-body">
                            <ol v-if="jobs.length > 0">
                                <li class="mb-5" v-for="job in jobs">
                                    <h5>{{ job.title }}</h5>
                                    <p>{{ job.description }}</p>
                                    <p>
                                        <a href="javascript:void(0);" @click="editJob(job.id)">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a href="javascript:void(0);" @click="deleteJob(job.id)">Delete</a>
                                    </p>
                                </li>
                            </ol>
                            <h5 v-if="jobs.length == 0">There are no jobs in the database</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios'

    export default {
        name: "job-listing",
        mounted() {
            this.getJobs()
        },
        data() {
            return {
                jobs : {},
                errors : {},
                jobTitle : '',
                jobDescription : '',
                jobId : '',
                isUpdate : 0
            }
        },
        methods : {
            getJobs() {
                axios.get('/api/getjobs').then(response => {
                    this.jobs = response.data
                }).catch(error => {
                    console.log(error)
                });
            },
            saveJob() {
                if(this.isUpdate == 0) {
                    axios.post('/api/savejob',{
                        title : this.jobTitle,
                        description : this.jobDescription
                    }).then(response => {
                        console.log(response.data)
                        if(response.data.errors) {
                            this.errors = response.data.errors
                        }
                        else {
                            this.getJobs()
                            this.jobTitle = ''
                            this.jobDescription = ''
                            this.errors = {}
                        }
                    }).catch(error => {
                        console.log(error)
                    });
                }
                else {
                    axios.put('/api/editjob',{
                        id : this.jobId,
                        title : this.jobTitle,
                        description : this.jobDescription
                    }).then(response => {
                        if(response.data.errors) {
                            this.errors = response.data.errors
                        }
                        else {
                            this.getJobs()
                            this.jobTitle = ''
                            this.jobDescription = ''
                            this.jobId = ''
                            this.isUpdate = 0
                            this.errors = {}
                        }
                    }).catch(error => {
                        console.log(error)
                    });
                }
            },
            deleteJob(id) {
                axios.post('api/deletejob',{
                    jobId : id
                }).then(response => {
                    this.getJobs()
                }).catch(error => {
                    console.log(error)
                });
            },
            editJob(id) {
                axios.post('/api/getjob',{
                    jobId : id
                }).then(response => {
                    this.jobTitle = response.data.title
                    this.jobDescription = response.data.description
                    this.jobId = response.data.id
                    this.isUpdate = 1
                }).catch(error => {
                    console.log(error)
                });
            }
        }
    }
</script>
