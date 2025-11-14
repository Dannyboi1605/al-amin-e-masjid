# Quick Start Guide - Forum Module

## 🚀 Getting Started

### 1. Database is Ready
✅ Migrations have been run successfully:
- `forums` table created
- `comments` table created

### 2. Access the Forum Module

**Public Access:**
- Browse forums: http://localhost/forums
- View forum post: http://localhost/forums/{slug}

**Admin Access (requires admin role):**
- Manage forums: http://localhost/admin/forums
- Create forum: http://localhost/admin/forums/create
- Moderate comments: http://localhost/admin/forums-comments

### 3. Navigation Links Added

**Public Navigation Bar:**
- New "Forum" menu item added between Pengumuman and Program Komuniti

**Admin Sidebar:**
- New "Forums" link in admin panel sidebar

**Homepage:**
- New forum card added to services section

**Admin Dashboard:**
- New forum card with quick link to forum management

---

## 📝 Create Your First Forum Post

### Method 1: Via Web Interface (Recommended)
1. Log in as admin
2. Go to `/admin/forums`
3. Click "Cipta Forum Baru"
4. Fill in:
   - **Title**: "Selamat Datang ke Forum Al-Amin"
   - **Content**: "Ini adalah forum perbincangan untuk komuniti masjid kita. Sila berkongsi pandangan dan bertanya soalan di sini."
5. Click "Cipta Forum"

### Method 2: Via Tinker
```bash
php artisan tinker
```

```php
// Create a sample forum post
App\Models\Forum::create([
    'title' => 'Selamat Datang ke Forum Al-Amin',
    'content' => 'Ini adalah forum perbincangan untuk komuniti masjid kita. Sila berbincang dan berkongsi pandangan di sini. Jangan lupa untuk menghormati semua ahli komuniti.',
    'user_id' => 1  // Make sure this admin user exists
]);

// Create another forum post
App\Models\Forum::create([
    'title' => 'Cadangan Program Ramadan 2025',
    'content' => 'Salam sejahtera kepada semua. Kami ingin mendapatkan cadangan daripada komuniti untuk program Ramadan tahun depan. Apa program yang anda ingin lihat?',
    'user_id' => 1
]);

// Create a comment
$forum = App\Models\Forum::first();
App\Models\Comment::create([
    'forum_id' => $forum->id,
    'user_id' => 1,
    'content' => 'Terima kasih atas forum ini! Sangat berfaedah.',
    'parent_id' => null
]);
```

---

## 🧪 Testing Checklist

### As Admin:
- [ ] Log in as admin user
- [ ] Navigate to `/admin/forums`
- [ ] Create a new forum post
- [ ] Edit the forum post
- [ ] View the forum on public page
- [ ] Go to `/admin/forums-comments`
- [ ] Test hiding/showing a comment
- [ ] Test deleting a comment
- [ ] Test restoring a deleted comment

### As Regular User:
- [ ] Log in as regular user
- [ ] Navigate to `/forums`
- [ ] Click on a forum post
- [ ] Post a comment
- [ ] Reply to a comment
- [ ] Verify nested replies display correctly

### As Guest:
- [ ] Visit `/forums` without logging in
- [ ] View forum posts
- [ ] Verify "log in to comment" message appears
- [ ] Verify cannot post comments

---

## 🔧 Troubleshooting

### "User not found" error when creating forum
**Solution:** Make sure you have at least one admin user in your database.

```bash
php artisan tinker
```

```php
// Create an admin user if you don't have one
$user = App\Models\User::first();
$user->role = 'admin';
$user->save();

// Or create a new admin user
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@alamin.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
    'is_active' => true
]);
```

### Forum link not showing in navigation
**Solution:** Clear your browser cache or do a hard refresh (Ctrl+Shift+R)

### Comments not displaying
**Solution:** Check if comments are marked as hidden in the admin panel

---

## 🎨 Customization Tips

### Change Forum Pagination
Edit `app/Http/Controllers/ForumController.php`:
```php
// Change from 10 to your desired number
$forums = Forum::with('author')->latest()->paginate(10);
```

### Add Rich Text Editor
To enable formatted text in forums, consider adding:
- TinyMCE
- Quill
- CKEditor

### Customize Colors
Edit the CSS in the blade templates to match your brand colors.

---

## 📊 Quick Stats Queries

Check forum stats using tinker:
```bash
php artisan tinker
```

```php
// Total forums
App\Models\Forum::count();

// Total comments
App\Models\Comment::count();

// Visible comments
App\Models\Comment::where('is_hidden', false)->count();

// Hidden comments
App\Models\Comment::where('is_hidden', true)->count();

// Deleted comments
App\Models\Comment::onlyTrashed()->count();

// Forums with most comments
App\Models\Forum::withCount('comments')->orderBy('comments_count', 'desc')->take(5)->get();
```

---

## ✅ You're All Set!

Your Forum Module is fully functional and ready to use. Navigate to `/forums` to see it in action!

For detailed documentation, see `FORUM_MODULE_README.md`.
