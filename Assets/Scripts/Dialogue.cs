using UnityEngine;

public class Dialogue : MonoBehaviour
{
    public Sprite profile;
    public string[] speechTxt;
    public string actorName;

    public LayerMask playerLayer;
    public float radious;

    private DialogueControl dc;
    bool onRadious;

    private void Start()
    {
        dc = FindObjectOfType<DialogueControl>();

    }

    private void FixedUpdate()
    {
        Interact();   
    }

    private void Update()
    {
        if (Input.GetMouseButtonDown(1) && onRadious)
        {
            
            if (!dc.dialogueObj.activeSelf)
            {
                dc.Speech(profile, speechTxt, actorName);
            }
            else
            {
                dc.NextSentence();
            }
        }
    }

    public void Interact()
    {
        Collider2D hit = Physics2D.OverlapCircle(transform.position, radious, playerLayer);

        if (hit != null)
        {
            onRadious = true;
        }
        else
        {
            onRadious = false;
        }
    }
    private void OnDrawGizmosSelected()
    {
        Gizmos.DrawWireSphere(transform.position, radious);
    }
}
