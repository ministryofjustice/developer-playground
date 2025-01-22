# frozen_string_literal: true

FactoryBot.define do
  factory :user do
    email { Faker::Internet.email }
    password { 'password' }
    password_confirmation { 'password' }
    created_at { Time.zone.local(2024) }
    updated_at { Time.zone.local(2024) }
    confirmed_at { Time.zone.now }
    factory :guest do
      role { 0 } # User: guest
    end

    factory :basic do
      role { 1 } # User: basic
    end

    factory :admin do
      role { 2 } # User: admin
    end
  end
end
