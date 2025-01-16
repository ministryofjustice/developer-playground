# frozen_string_literal: true

class SearchController < ApplicationController
  # using ransack method, return all search matches
  # found using search_form_for GET method
  # sort returned results
  def index
    @q = Article.ransack(params[:q])
    @articles = @q.result(distinct: true)
  end
end
