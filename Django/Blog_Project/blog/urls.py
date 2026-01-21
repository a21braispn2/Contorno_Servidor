from django.urls import path
from .views import HomeView, AllPostsView, SinglePostView, ReadLaterView, StoredPostsView

urlpatterns = [
    path('', HomeView.as_view(), name='home'),
    path('posts/', AllPostsView.as_view(), name='all-posts'),
    path('post/<int:pk>/', SinglePostView.as_view(), name='post-detail'),
    path('read-later/<int:pk>/', ReadLaterView.as_view(), name='read-later'),
    path('stored-posts/', StoredPostsView.as_view(), name='stored-posts'),
]

