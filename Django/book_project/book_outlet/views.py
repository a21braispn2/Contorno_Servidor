from django.shortcuts import render

# Create your views here.
from django.shortcuts import render
from django.db.models import Q
from .models import Book

def book_list(request):
    high_rated_books = Book.objects.order_by('-rating')

    potter_complex_query = Book.objects.filter(
        title__icontains='Potter'
    ).filter(
        Q(is_bestselling=True) | Q(rating__gt=3)
    )

    rolling_bestsellers = Book.objects.filter(
        author__first_name="J.K.",
        author__last_name="Rolling",
        is_bestselling=True
    )

    context = {
        'high_rated_books': high_rated_books,
        'potter_books': potter_complex_query,
        'rolling_books': rolling_bestsellers,
    }

    return render(request, 'book_outlet/book_list.html', context)