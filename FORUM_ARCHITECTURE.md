# Forum Module Architecture

## 📐 Database Schema Diagram

```
┌─────────────────────────┐
│       USERS             │
│─────────────────────────│
│ id (PK)                 │
│ name                    │
│ email                   │
│ role                    │
│ ...                     │
└───────────┬─────────────┘
            │
            │ 1:N
            │
┌───────────▼─────────────┐
│       FORUMS            │
│─────────────────────────│
│ id (PK)                 │
│ title                   │
│ slug (unique)           │
│ content                 │
│ user_id (FK) ───────────┤
│ created_at              │
│ updated_at              │
└───────────┬─────────────┘
            │
            │ 1:N
            │
┌───────────▼─────────────┐
│      COMMENTS           │
│─────────────────────────│
│ id (PK)                 │
│ forum_id (FK) ──────────┤
│ user_id (FK) ───────────┤
│ parent_id (FK, nullable)│ ◄─┐
│ content                 │   │ Self-referential
│ is_hidden (boolean)     │   │ (Nested replies)
│ created_at              │   │
│ updated_at              │   │
│ deleted_at (soft delete)│   │
└─────────────────────────┘   │
            │                  │
            └──────────────────┘
```

## 🗂️ File Organization

```
al-amin-e-masjid/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ForumController.php           # Public forum browsing
│   │       ├── AdminForumController.php      # Admin CRUD operations
│   │       └── CommentController.php         # Comment handling
│   │
│   └── Models/
│       ├── Forum.php                         # Forum model
│       └── Comment.php                       # Comment model (soft deletes)
│
├── database/
│   └── migrations/
│       ├── 2025_11_14_100000_create_forums_table.php
│       └── 2025_11_14_100001_create_comments_table.php
│
├── resources/
│   └── views/
│       ├── forums/                           # Public views
│       │   ├── index.blade.php               # Forum list
│       │   ├── show.blade.php                # Single forum + comments
│       │   └── partials/
│       │       └── comment.blade.php         # Recursive comment component
│       │
│       └── admin/
│           └── forums/                       # Admin views
│               ├── index.blade.php           # Admin forum list
│               ├── create.blade.php          # Create forum
│               ├── edit.blade.php            # Edit forum
│               └── comments.blade.php        # Comment moderation
│
└── routes/
    └── web.php                               # All forum routes defined here
```

## 🔄 Request Flow Diagram

### Public Forum View Flow
```
User Request
    │
    ▼
/forums ──────► ForumController@index
    │                   │
    │                   ▼
    │           Forum::with('author')
    │                   │
    │                   ▼
    │           forums/index.blade.php
    │                   │
    │                   ▼
    │           Display forum list with pagination
    │
    ▼
/forums/{slug} ──► ForumController@show
    │                   │
    │                   ▼
    │           Forum::with(['author', 'topLevelComments.user', ...])
    │                   │
    │                   ▼
    │           forums/show.blade.php
    │                   │
    │                   ▼
    │           Display forum + nested comments
    │
    ▼
POST /forums/{forum}/comments ──► CommentController@store
                    │
                    ▼
            Validate & Create Comment
                    │
                    ▼
            Redirect back with success message
```

### Admin Forum Management Flow
```
Admin Request
    │
    ▼
/admin/forums ──────► AdminForumController@index
    │                       │
    │                       ▼
    │               Forum::withCount('comments')
    │                       │
    │                       ▼
    │               admin/forums/index.blade.php
    │
    ▼
/admin/forums/create ───► AdminForumController@create
    │                       │
    │                       ▼
    │               admin/forums/create.blade.php
    │
    ▼
POST /admin/forums ──────► AdminForumController@store
    │                       │
    │                       ▼
    │               Validate + Generate Slug
    │                       │
    │                       ▼
    │               Create Forum
    │                       │
    │                       ▼
    │               Redirect to index with success
    │
    ▼
/admin/forums-comments ──► AdminForumController@comments
                            │
                            ▼
                    Comment::with(['user', 'forum'])
                            │
                            ▼
                    Filter by status (all/visible/hidden/deleted)
                            │
                            ▼
                    Sort by date (newest/oldest)
                            │
                            ▼
                    admin/forums/comments.blade.php
```

## 🔐 Authorization Matrix

```
┌──────────────────────┬───────┬──────┬───────┐
│ Action               │ Guest │ User │ Admin │
├──────────────────────┼───────┼──────┼───────┤
│ View forum list      │   ✓   │  ✓   │   ✓   │
│ View forum post      │   ✓   │  ✓   │   ✓   │
│ Post comment         │   ✗   │  ✓   │   ✓   │
│ Reply to comment     │   ✗   │  ✓   │   ✓   │
│ Create forum post    │   ✗   │  ✗   │   ✓   │
│ Edit forum post      │   ✗   │  ✗   │   ✓   │
│ Delete forum post    │   ✗   │  ✗   │   ✓   │
│ Hide/show comments   │   ✗   │  ✗   │   ✓   │
│ Delete comments      │   ✗   │  ✗   │   ✓   │
│ Restore comments     │   ✗   │  ✗   │   ✓   │
│ View comment stats   │   ✗   │  ✗   │   ✓   │
└──────────────────────┴───────┴──────┴───────┘
```

## 🎯 Model Relationships Diagram

```
User Model
├── hasMany → Forums (as author)
└── hasMany → Comments

Forum Model
├── belongsTo → User (author)
├── hasMany → Comments (all)
└── hasMany → Comments (topLevelComments - no parent)

Comment Model
├── belongsTo → Forum
├── belongsTo → User
├── belongsTo → Comment (parent) [Self-reference]
└── hasMany → Comments (replies) [Self-reference]
```

## 🌐 Route Structure

```
PUBLIC ROUTES
├── GET  /forums                                → List all forums
└── GET  /forums/{slug}                         → Show single forum

AUTHENTICATED ROUTES
└── POST /forums/{forum}/comments               → Store new comment

ADMIN ROUTES (prefix: /admin)
├── Forum Management
│   ├── GET    /admin/forums                    → List all forums (admin)
│   ├── GET    /admin/forums/create             → Create form
│   ├── POST   /admin/forums                    → Store forum
│   ├── GET    /admin/forums/{forum}/edit       → Edit form
│   ├── PUT    /admin/forums/{forum}            → Update forum
│   └── DELETE /admin/forums/{forum}            → Delete forum
│
└── Comment Moderation
    ├── GET    /admin/forums-comments            → Comment moderation panel
    ├── POST   /admin/comments/{id}/toggle-hidden → Hide/show comment
    ├── DELETE /admin/comments/{id}              → Soft delete comment
    ├── POST   /admin/comments/{id}/restore      → Restore comment
    └── DELETE /admin/comments/{id}/force-delete → Permanent delete
```

## 📊 Data Flow for Nested Comments

```
Forum Post
    │
    ├─ Comment 1 (parent_id: null)
    │   │
    │   ├─ Reply 1.1 (parent_id: 1)
    │   │   │
    │   │   └─ Reply 1.1.1 (parent_id: 1.1)
    │   │
    │   └─ Reply 1.2 (parent_id: 1)
    │
    ├─ Comment 2 (parent_id: null)
    │   │
    │   └─ Reply 2.1 (parent_id: 2)
    │
    └─ Comment 3 (parent_id: null)

Blade Rendering (Recursive):
@include('forums.partials.comment', ['comment' => $comment])
    └─> Calls itself for each reply
        └─> Infinite nesting support
```

## 🔍 Key Features Visual Map

```
┌─────────────────────────────────────────┐
│         FORUM MODULE FEATURES           │
├─────────────────────────────────────────┤
│                                         │
│  📝 Forum Posts                         │
│  ├─ Auto-generated slugs                │
│  ├─ Rich text content                   │
│  ├─ Author tracking                     │
│  └─ Timestamps                          │
│                                         │
│  💬 Comments System                     │
│  ├─ Nested replies (unlimited depth)   │
│  ├─ User attribution                    │
│  ├─ Soft deletes                        │
│  └─ Visibility toggle (hide/show)      │
│                                         │
│  🛡️ Admin Tools                         │
│  ├─ Full CRUD for forums               │
│  ├─ Comment moderation dashboard        │
│  ├─ Filter by status                    │
│  ├─ Sort options                        │
│  └─ Statistics overview                 │
│                                         │
│  🎨 UI Components                       │
│  ├─ Responsive design                   │
│  ├─ Pagination                          │
│  ├─ Avatar placeholders                 │
│  ├─ Admin badges                        │
│  └─ Success/error alerts                │
│                                         │
└─────────────────────────────────────────┘
```

---

This architecture provides a scalable, maintainable forum system with proper separation of concerns and security measures.
