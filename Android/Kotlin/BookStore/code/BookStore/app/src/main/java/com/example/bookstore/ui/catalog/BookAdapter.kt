package com.example.bookstore.ui.catalog

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.example.bookstore.R
import com.example.bookstore.models.Book

class BookAdapter(
    private val books: List<Book>,
    private val onItemClick: (Int) -> Unit
) : RecyclerView.Adapter<BookAdapter.BookViewHolder>() {

    inner class BookViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        private val imageView: ImageView = itemView.findViewById(R.id.book_image)
        private val titleView: TextView = itemView.findViewById(R.id.book_title)
        private val authorView: TextView = itemView.findViewById(R.id.book_author)
        private val priceView: TextView = itemView.findViewById(R.id.book_price)
        private val detailsButton: View = itemView.findViewById(R.id.details_button)

        fun bind(book: Book) {
            // Загрузка изображения с помощью Glide
            Glide.with(itemView.context)
                .load("https://gvev.ru/diplom/${book.img}")
                .placeholder(R.drawable.ic_book_placeholder) // Заглушка
                .into(imageView)

            titleView.text = book.name
            authorView.text = book.author
            priceView.text = "${book.price} ₽"

            detailsButton.setOnClickListener {
                onItemClick(book.id)
            }
        }
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): BookViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_book, parent, false)
        return BookViewHolder(view)
    }

    override fun onBindViewHolder(holder: BookViewHolder, position: Int) {
        holder.bind(books[position])
    }

    override fun getItemCount(): Int = books.size
}