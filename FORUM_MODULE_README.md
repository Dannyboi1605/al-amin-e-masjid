# Forum Module - Documentation

## 📋 Overview
A complete Forum Module has been successfully integrated into your Laravel Al-Amin E-Masjid project with full CRUD operations, nested comments system, and admin moderation tools.

---

## 🗂️ File Structure

### **Migrations**
- `database/migrations/2025_11_14_100000_create_forums_table.php`
- `database/migrations/2025_11_14_100001_create_comments_table.php`

### **Models**
- `app/Models/Forum.php` - Forum post model with slug auto-generation
- `app/Models/Comment.php` - Comment model with soft deletes and self-referential relationships

### **Controllers**
- `app/Http/Controllers/ForumController.php` - Public forum display
- `app/Http/Controllers/AdminForumController.php` - Admin CRUD operations
- `app/Http/Controllers/CommentController.php` - Comment management

### **Public Views** (`resources/views/forums/`)
- `index.blade.php` - List all forum posts
- `show.blade.php` - Single forum post with comments
- `partials/comment.blade.php` - Recursive comment component

### **Admin Views** (`resources/views/admin/forums/`)
- `index.blade.php` - Forum list for admin
- `create.blade.php` - Create new forum post
- `edit.blade.php` - Edit existing forum post
- `comments.blade.php` - Comment moderation panel

---

## 🎯 Features Implemented

### ✅ Admin Features (Admin Only)
1. **Forum Post CRUD**
   - Create forum posts with title and content
   - Auto-generate unique slugs from titles
   - Edit existing forum posts
   - Delete forum posts (cascades to comments)
   - View all forum posts with comment counts

2. **Comment Moderation**
   - View all comments with filtering (all/visible/hidden/deleted)
   - Sort comments by newest/oldest
   - Toggle comment visibility (hide/show)
   - Soft delete comments
   - Restore soft-deleted comments
   - Permanently delete comments
   - View comment statistics

### ✅ User Features (All Authenticated Users)
1. **Forum Browsing**
   - View all forum posts
   - Read individual forum posts
   - See nested comment threads

2. **Commenting System**
   - Post comments on forum posts
   - Reply to other comments (nested replies)
   - Unlimited nesting depth support
   - Real-time comment display

### ✅ Public Features
- Browse all forum posts
- Read forum content and comments
- Guest users can view but not comment

---

## 📦 Database Schema

### **forums** Table
```
- id (primary key)
- title (string)
- slug (unique string)
- content (text)
- user_id (foreign key → users)
- timestamps
```

### **comments** Table
```
- id (primary key)
- forum_id (foreign key → forums)
- user_id (foreign key → users)
- parent_id (nullable, foreign key → comments, self-reference)
- content (text)
- is_hidden (boolean, default: false)
- timestamps
- deleted_at (soft deletes)
```

---

## 🛣️ Routes

### **Public Routes**
```php
GET  /forums              → ForumController@index         → forums.index
GET  /forums/{slug}       → ForumController@show          → forums.show
```

### **Authenticated Routes**
```php
POST /forums/{forum}/comments → CommentController@store   → forums.comments.store
```

### **Admin Routes** (Requires Auth + Admin Role)
```php
// Forum Management
GET    /admin/forums                    → AdminForumController@index     → admin.forums.index
GET    /admin/forums/create             → AdminForumController@create    → admin.forums.create
POST   /admin/forums                    → AdminForumController@store     → admin.forums.store
GET    /admin/forums/{forum}/edit       → AdminForumController@edit      → admin.forums.edit
PUT    /admin/forums/{forum}            → AdminForumController@update    → admin.forums.update
DELETE /admin/forums/{forum}            → AdminForumController@destroy   → admin.forums.destroy

// Comment Moderation
GET    /admin/forums-comments                   → AdminForumController@comments      → admin.forums.comments
POST   /admin/comments/{comment}/toggle-hidden  → CommentController@toggleHidden     → admin.comments.toggle-hidden
DELETE /admin/comments/{comment}                → CommentController@destroy          → admin.comments.destroy
POST   /admin/comments/{id}/restore             → CommentController@restore          → admin.comments.restore
DELETE /admin/comments/{id}/force-delete        → CommentController@forceDelete      → admin.comments.force-delete
```

---

## 🔗 Model Relationships

### **Forum Model**
```php
author()              → belongsTo User
comments()            → hasMany Comment
topLevelComments()    → hasMany Comment (whereNull parent_id, not hidden)
```

### **Comment Model**
```php
forum()       → belongsTo Forum
user()        → belongsTo User
parent()      → belongsTo Comment (self-reference)
replies()     → hasMany Comment (not hidden)
allReplies()  → hasMany Comment (including hidden)
```

---

## 🎨 UI Features

### **Public Forum Views**
- Bootstrap/Tailwind compatible design
- Responsive layout
- Pagination support
- User avatars with initials
- Admin badge for admin users
- Nested comment display with indentation
- Reply forms with toggle functionality
- Success/error message alerts

### **Admin Panel**
- Consistent with existing admin design
- Table-based listings with actions
- Filter and sort controls
- Color-coded status badges
- Inline action buttons
- Statistics dashboard
- Confirmation dialogs for destructive actions

---

## 🚀 Usage Examples

### **Creating a Forum Post (Admin)**
1. Navigate to `/admin/forums`
2. Click "Cipta Forum Baru"
3. Enter title and content
4. Submit - slug is auto-generated

### **Commenting on a Forum**
1. Navigate to `/forums`
2. Click on a forum post
3. Log in if not authenticated
4. Write your comment and submit
5. To reply, click "Balas" on any comment

### **Moderating Comments (Admin)**
1. Navigate to `/admin/forums-comments`
2. Filter by status (all/visible/hidden/deleted)
3. Use action buttons to:
   - Toggle visibility (eye icon)
   - Soft delete (trash icon)
   - Restore deleted comments
   - Permanently delete

---

## 🔒 Security & Validation

### **Validation Rules**
- **Forum Post**: Title (required, max 255), Content (required)
- **Comment**: Content (required, max 2000), Parent ID (nullable, must exist)

### **Authorization**
- Forum creation/editing: Admin only (middleware: auth, admin)
- Comment posting: Authenticated users only
- Comment moderation: Admin only
- Public viewing: Everyone

### **Soft Deletes**
- Comments use soft deletes for safety
- Admins can restore accidentally deleted comments
- Permanent deletion requires additional confirmation

---

## 🎯 Next Steps (Optional Enhancements)

1. **Rich Text Editor** - Add TinyMCE or Quill for formatted content
2. **File Attachments** - Allow image/file uploads in posts
3. **Reactions** - Add like/dislike functionality
4. **Notifications** - Email users when someone replies
5. **Flagging System** - Let users report inappropriate comments
6. **Search** - Add forum search functionality
7. **Categories** - Organize forums into categories
8. **Pinned Posts** - Allow pinning important forum posts

---

## 📝 Testing

### **Manual Testing Checklist**

**As Admin:**
- [ ] Create a forum post
- [ ] Edit a forum post
- [ ] Delete a forum post
- [ ] View forum list in admin panel
- [ ] Access comment moderation page
- [ ] Hide/show comments
- [ ] Delete and restore comments

**As User:**
- [ ] View forum list
- [ ] Read a forum post
- [ ] Post a comment
- [ ] Reply to a comment
- [ ] View nested replies

**As Guest:**
- [ ] View forum list
- [ ] Read forum posts
- [ ] Verify cannot comment without login

---

## 🐛 Troubleshooting

### **Issue: Slug conflicts**
- Solution: Automatic unique slug generation is implemented with numeric suffixes

### **Issue: Comments not showing**
- Check `is_hidden` status
- Verify comment hasn't been soft deleted
- Ensure parent_id is valid for replies

### **Issue: Permission denied**
- Verify user has 'admin' role for admin routes
- Check middleware is properly applied

---

## ✅ Migrations Applied
```
✓ 2025_11_14_100000_create_forums_table
✓ 2025_11_14_100001_create_comments_table
```

---

## 🎉 Summary

Your Forum Module is now fully functional with:
- ✅ Complete CRUD for forum posts (Admin)
- ✅ Nested comments system (All users)
- ✅ Comment moderation tools (Admin)
- ✅ Soft deletes with restore capability
- ✅ Clean, responsive UI matching your existing design
- ✅ Proper relationships and validation
- ✅ Security and authorization

Navigate to `/forums` to see it in action!
