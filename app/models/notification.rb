# frozen_string_literal: true

# == Schema Information
#
# Table name: notifications
#
#  id             :integer          not null, primary key
#  recipient_type :string           not null
#  recipient_id   :integer          not null
#  type           :string           not null
#  params         :json
#  read_at        :datetime
#  created_at     :datetime         not null
#  updated_at     :datetime         not null
#
class Notification < ApplicationRecord
  include Noticed::Model
  belongs_to :recipient, polymorphic: true
end
