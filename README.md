# Mugo Conference Survey

## Customizing form text strings
In `index.php` edit the `$opts` array to modify various text strings

## Customizing form questions
In `index.php` edit the `$json` array to add or remove questions.

Here's a sample `$json` array:
```json
[
    {
        "id": 1,
        "text": "Describe the presentation with a single word.",
        "type": "input",
        "placeholder": "Be creative.",
        "answers": []
    },{
        "id": 2,
        "text": "In your own words, what is one thing you would change about the presentation if you could?",
        "type": "textarea",
        "placeholder": "Please be as specific as possible.",
        "answers": []
    },{
        "id": 3,
        "text": "How satisfied were you with the presentation?",
        "type": "select",
        "placeholder": "Please select an item",
        "answers": [
            { 
                "not_satisfied": "Not Satisfied" 
            },
            { 
                "somewhat_satisfied": "Somewhat Satisfied"
            },
            { 
                "very_satisfied": "Very Satisfied"
            }
        ]
    },{
        "id": 4,
        "text": "Besides talk to us, what else did you do at the conference?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "other_vendors": "I visited other vendors" 
            },
            { 
                "price_quotes": "I requested an explicit quote"
            },
            { 
                "networking": "I did some networking"
            }
        ]
    },{
        "id": 5,
        "text": "Would you recommend Mugo to someone in the industry?",
        "type": "radio",
        "placeholder": "",
        "answers": [
            { 
                "maybe": "I think I might" 
            },
            { 
                "yes": "I think I would"
            },
            { 
                "no": "I don't think very often"
            }
        ]
    }
]
```

A few things to note about questions:
* `id` should be unique for each question or things will break.
* `type` should be one of `input`, `textarea`, `select`, `checkbox`, or `radio`.
* if you'd like to add a new type, create a `case` block for it in `templates/survey.php` and add a new template for it 
using the naming convention `survey_<<TYPE>>.php`.

## Results
Submitted results are JSON-encoded and saved into `survey.log`.