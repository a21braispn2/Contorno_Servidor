from django.shortcuts import render, get_object_or_404, redirect
from django.urls import reverse
from django.views import View

from .models import Post
from .forms import CommentForm

# --- Home / Index View ---
class HomeView(View):
    def get(self, request):
        posts = Post.objects.all().order_by('-date')
        return render(request, 'blog/home.html', {'posts': posts})

# --- All Posts View ---
class AllPostsView(View):
    def get(self, request):
        posts = Post.objects.all().order_by('-date')
        return render(request, 'blog/all_posts.html', {'posts': posts})

# --- Single Post Detail + Comments + Read Later ---
class SinglePostView(View):
    def get(self, request, pk):
        post = get_object_or_404(Post, pk=pk)
        form = CommentForm()
        comments = post.comments.all().order_by('-created_at')
        stored_posts = request.session.get("stored_posts", [])
        is_saved_for_later = pk in stored_posts

        return render(request, 'blog/post_detail.html', {
            'post': post,
            'form': form,
            'comments': comments,
            'is_saved_for_later': is_saved_for_later,
        })

    def post(self, request, pk):
        post = get_object_or_404(Post, pk=pk)
        form = CommentForm(request.POST)
        if form.is_valid():
            comment = form.save(commit=False)
            comment.post = post
            comment.save()
            return redirect(reverse('post-detail', args=[pk]))

        comments = post.comments.all().order_by('-created_at')
        stored_posts = request.session.get("stored_posts", [])
        is_saved_for_later = pk in stored_posts

        return render(request, 'blog/post_detail.html', {
            'post': post,
            'form': form,
            'comments': comments,
            'is_saved_for_later': is_saved_for_later,
        })

# --- Read Later Feature ---
class ReadLaterView(View):
    def post(self, request, pk):
        stored_posts = request.session.get("stored_posts", [])

        if pk in stored_posts:
            stored_posts.remove(pk)
        else:
            stored_posts.append(pk)

        request.session["stored_posts"] = stored_posts
        return redirect(reverse('post-detail', args=[pk]))

# --- View to display all posts saved for Read Later ---
class StoredPostsView(View):
    def get(self, request):
        stored_posts = request.session.get("stored_posts", [])
        posts = Post.objects.filter(id__in=stored_posts).order_by('-date')
        return render(request, 'blog/stored_posts.html', {'posts': posts})
