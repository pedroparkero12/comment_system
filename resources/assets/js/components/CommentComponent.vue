<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Juan Dela Cruz</h5>
                        <h6 class="card-subtitle mb-2 text-muted">07/08/08 12:00:00 AM</h6>
                        <p class="card-text">This is a simple web comment system. Click "write a comment to comment". You can also reply to other comments.</p>
                        <a href="#" class="card-link" @click="showCommentModal()">Write a comment</a>
                        <hr>
                        <div class="card-body"  v-for="comment in root_comments">
                            <h5 class="card-title">{{comment.name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{comment.created_at}}</h6>
                            <p class="card-text">{{comment.content}}</p>
                            <a href="#" class="card-link" @click="showCommentModal(comment.id)">Reply</a>
                            <div v-for="(value,key) in comments">
                                <div class="card-body"  v-for="child_comment1 in value" v-if="key==comment.id">
                                    <hr>
                                    <h5 class="card-title">{{child_comment1.name}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{child_comment1.created_at}}</h6>
                                    <p class="card-text">{{child_comment1.content}}</p>
                                    <a href="#" class="card-link" @click="showCommentModal(child_comment1.id)">Reply</a>
                                    <div v-for="(value,key) in comments">
                                        <div class="card-body"  v-for="child_comment2 in value" v-if="key==child_comment1.id">
                                            <hr>
                                            <h5 class="card-title">{{child_comment2.name}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{child_comment2.created_at}}</h6>
                                            <p class="card-text">{{child_comment2.content}}</p>
                                            <a href="#" class="card-link" @click="showCommentModal(child_comment1.id)">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="write_comment" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Write a comment
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" v-model="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" id="content" v-model="content" class="form-control">
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" @click="addComment">Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</template>

<script>
    export default {
        data() {
			return {
                root_comments: [],
                comments: [],
                parent_id:null,
                name:'',
                content:'',
                errors:[]
            }
        },
        ready(){
            this.prepareComponent();
        },
        mounted(){
            this.prepareComponent();
        },
        methods: {
            prepareComponent() {
                this.getComments();
            },
            getComments(){
                axios.get(`/comments`+`?no_parent=""`)
                .then((response) => {
                    this.root_comments = response.data;
                });
                axios.get(`/comments`)
                .then((response) => {
                    this.comments = response.data;
                });
            },
            clearFields(){
                this.name = '';
                this.content = '';
            },
            showCommentModal(parent_id){
                if(parent_id==undefined) this.parent_id=null;
                else this.parent_id = parent_id
                $('#write_comment').modal('show');
            },
            checkForm(){
                if (this.name && this.content) {
                    return true;
                }
                
                this.errors = [];
                
                if (!this.name) {
                    this.errors.push('Name is required.');
                }
                if (!this.content) {
                    this.errors.push('Comment is required.');
                }
                
            },
            addComment(){
                if(this.checkForm()){
                    var data = {'post_id':1,'name':this.name,'content':this.content,'parent_id':this.parent_id};

                    axios.post(`/comments`,data)
                    .then((response) => { 
                        $('#write_comment').modal('hide');
                        this.clearFields();
                        this.getComments();
                    })
                }
                else{
                    alert(this.errors);
                }
            }
            
		}
    }
</script>
