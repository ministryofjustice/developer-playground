# frozen_string_literal: true

# == Schema Information
#
# Table name: comments
#
#  id         :integer          not null, primary key
#  commenter  :string
#  body       :text
#  article_id :integer          not null
#  created_at :datetime         not null
#  updated_at :datetime         not null
#  status     :string
#  user_id    :integer          not null
#
class Comment < ApplicationRecord
  # include Visible

  belongs_to :article
  belongs_to :user
  has_rich_text :body

  after_create_commit :notify_recipient
  before_destroy :cleanup_notifications
  has_noticed_notifications model_name: 'Notification'

  private

  # Provide the parameters using .with to use them
  # in the methods and callbacks in the instance,
  # The deliver_later takes advantage of ACTIVE JOB, which allows
  # emails to be sent outside of the request response cycle
  def notify_recipient
    CommentNotification.with(comment: self, article:).deliver_later(article.user)
  end

  def cleanup_notifications
    notifications_as_comment.destroy_all
  end
end
