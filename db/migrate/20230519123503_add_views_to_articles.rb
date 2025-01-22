# frozen_string_literal: true

class AddViewsToArticles < ActiveRecord::Migration[7.0]
  def change
    add_column :articles, :views, :integer, default: 0
  end
end
