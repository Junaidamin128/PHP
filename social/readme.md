# Social

## TODO
- Friend list
- Load more Posts

## Entities


## Flow

User registration/Login
Profile Edit/ Profile view
Friend system
Notifications
Posts
Comments
Messages



# ERD (Tables)
Table USER
- uid
- Full name
- username
- email
- Password
- Profile Pic
- Phone
- created ( timestamp )


Posts
- pid
- Body
- author
- created

PostsImages
- postImageID
- pid
- imageName


Comments
- cid
- author
- pid
- body



Messages
- mid
- senderID
- receiverID
- msg
- seenFlag


Friends
- sender
- receiver
- accepted


Notifications
- nid
- title
- body
- type
- referenceID
- created
- readFlag