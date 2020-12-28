<template>
    <div>
        <button type="submit" style="width: 100px" class="btn btn-primary btn-sm ml-2 mr-2" @click="submitActiveShift" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: [
            'activeShiftId',
            'submitted',
        ],
        name: "SubmitButton",

        data: function() {
            return {
                status: this.submitted,
            }
        },
        methods: {
            submitActiveShift() {
                axios.post('/active-shift/submit/' + this.activeShiftId)
                .then(response => {
                    if (this.status == false) {
                        this.status = 1;
                    }

                    console.log(this.status);
                });
            }
        },
        computed: {
            buttonText() {
                if (this.status == 1) {
                    return 'Υπεβλήθη';
                } else {
                    return 'Υποβολή';
                }
            }
        }
    }
</script>

<style scoped>

</style>
