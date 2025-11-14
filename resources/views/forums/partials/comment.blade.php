<div class="comment-item mb-3 {{ $comment->isReply() ? 'ms-4' : '' }}" id="comment-{{ $comment->id }}">
    <div class="card {{ $comment->isReply() ? 'border-start border-3' : '' }}">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar-circle">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </div>
                </div>
                
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong class="text-dark">{{ $comment->user->name }}</strong>
                            @if($comment->user->role === 'admin')
                                <span class="badge bg-danger ms-2">Admin</span>
                            @endif
                            <div class="text-muted small">
                                <i class="fas fa-clock me-1"></i>{{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <div class="comment-content mb-2">
                        {{ $comment->content }}
                    </div>

                    @auth
                        <button 
                            type="button" 
                            class="btn btn-sm btn-link text-decoration-none p-0" 
                            onclick="toggleReplyForm({{ $comment->id }})"
                        >
                            <i class="fas fa-reply me-1"></i>Balas
                        </button>

                        <!-- Reply Form (Hidden by Default) -->
                        <div id="reply-form-{{ $comment->id }}" class="reply-form mt-3 p-3 bg-light rounded" style="display: none;">
                            <form action="{{ route('forums.comments.store', $forum->slug) }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <div class="mb-2">
                                    <textarea 
                                        name="content" 
                                        class="form-control form-control-sm" 
                                        rows="3" 
                                        placeholder="Tulis balasan anda..."
                                        required
                                    ></textarea>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane me-1"></i>Hantar
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-secondary btn-sm" 
                                        onclick="toggleReplyForm({{ $comment->id }})"
                                    >
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endauth

                    <!-- Nested Replies -->
                    @if($comment->replies->count() > 0)
                        <div class="replies mt-3">
                            @foreach($comment->replies as $reply)
                                @include('forums.partials.comment', ['comment' => $reply, 'forum' => $forum])
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }
    .comment-item .card {
        border-left-color: #5c6bc0 !important;
    }
    .comment-content {
        line-height: 1.6;
    }
    .reply-form {
        border-left: 3px solid #5c6bc0;
    }
</style>
