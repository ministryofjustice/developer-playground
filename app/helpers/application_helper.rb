# frozen_string_literal: true

module ApplicationHelper
  # For comment notification indicator colour
  def read_unread_style
    @unread.count.zero? ? 'read' : 'unread' # rubocop:disable RSpec/HelperInstanceVariable
  end

  def present_num_of_articles
    "The forum has #{pluralize(Article.count, 'article')}"
  end

  def present_num_of_admins
    "The forum has #{pluralize(User.where(role: 2).count, 'admin')}"
  end

  def present_num_of_users
    "The forum has #{pluralize(User.where(role: 1).count, 'basic user')}"
  end
end
