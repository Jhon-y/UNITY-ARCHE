using UnityEngine;

public class TeleporteAutomatico : MonoBehaviour
{
    public Transform destino; // arraste aqui o ponto de destino no Inspector

    private void OnTriggerEnter2D(Collider2D other)
    {
        if (other.CompareTag("Player"))
        {
            other.transform.position = destino.position;
        }
    }
}
