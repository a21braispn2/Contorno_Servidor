from django.contrib import admin
from .models import Post, Author, Tag, Comment

@admin.register(Post)
class PostAdmin(admin.ModelAdmin):
    list_display = ('title', 'author', 'date')
    list_filter = ('author', 'tags')
    search_fields = ('title', 'content')
