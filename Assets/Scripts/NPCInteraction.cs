using UnityEngine;

public class NPCInteraction : MonoBehaviour
{
    public string mensagem = "Ol�, bem-vindo � vila!";
    private bool jogadorPerto = false;

    void Update()
    {
        if (jogadorPerto && Input.GetKeyDown(KeyCode.E))
        {
            // Aqui voc� pode chamar o sistema de di�logo
            Debug.Log(mensagem);
            // Exemplo: DialogueManager.Instance.MostrarMensagem(mensagem);
        }
    }

    void OnTriggerEnter2D(Collider2D other)
    {
        if (other.CompareTag("Player"))
        {
            jogadorPerto = true;
        }
    }

    void OnTriggerExit2D(Collider2D other)
    {
        if (other.CompareTag("Player"))
        {
            jogadorPerto = false;
        }
    }
}
