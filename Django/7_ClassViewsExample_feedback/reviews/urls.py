from django.urls import path
from . import views

urlpatterns = [
    path("", views.ReviewView.as_view()),
    path("thank-you", views.ThankYouView.as_view(), name="thank-you"),
    path("reviews", views.ReviewsListView.as_view()),
    path("reviews/<int:pk>", views.SingleReviewView.as_view(), name="singleReview"),
    path("reviews/<int:pk>/edit", views.UpdateReviewView.as_view(), name="reviewEdit"),
    path("reviews/<int:pk>/delete", views.DeleteReviewView.as_view(), name="deleteEdit"),
]