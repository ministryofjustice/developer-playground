# frozen_string_literal: true

# == Schema Information
#
# Table name: articles
#
#  id         :integer          not null, primary key
#  title      :string
#  body       :text
#  created_at :datetime         not null
#  updated_at :datetime         not null
#  status     :string
#  user_id    :integer          not null
#  views      :integer          default(0)
#
FactoryBot.define do
  factory :article do
    title { Faker::Lorem.words(number: 2) }
    body { Faker::Lorem.paragraphs }
    created_at { Faker::Time.between(from: DateTime.now - 1, to: DateTime.now) }
    updated_at { Faker::Time.between(from: DateTime.now - 1, to: DateTime.now) }
    status { 'public' }
    user factory: %i[user]
  end
end
